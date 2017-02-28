# -*- coding: utf-8 -*-
import scrapy
from kaskopy import items


class KolesaSpider(scrapy.Spider):
    name = "kolesa"
    allowed_domains = ["kolesa.kz"]
    start_urls = ['https://kolesa.kz/cars/almaty/']

    def parse(self, response):
        links = response.css('.list-item .list-title .list-link::attr(href)')
        for link in links.extract():
            item_link = response.urljoin(link)
            yield scrapy.Request(item_link, callback=self.parse_item)

        next_page_selector = '.pager a.right-arrow.next_page::attr(href)'
        next_page = response.css(next_page_selector).extract_first()

        if next_page is not None:
            next_page = response.urljoin(next_page)
            yield scrapy.Request(next_page, callback=self.parse)

    def parse_item(self, response):
        car_item = items.CarItem()
        options = response.css('h1 span::text');
        car_item['brand'] = options[0].extract().strip()
        car_item['model'] = options[1].extract().strip()
        car_item['year'] = options[2].extract().strip()
        price = response.css('.dollar::text').extract_first().split()[:-1]
        car_item['price'] = ''.join(price)
        yield car_item
