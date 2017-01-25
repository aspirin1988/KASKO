# -*- coding: utf-8 -*-
import scrapy
from kaskopy import items


class A1kzSpider(scrapy.Spider):
    name = "1kz"
    allowed_domains = ["www.1.kz"]
    start_urls = ['http://www.1.kz/almaty/classifieds/legkovie.html']

    def parse(self, response):
        cars = response.css('.blocks_c.cs-list-item')

        for car in cars:
            car_item = items.CarItem()
            block = car.css('.blocks_bt_top>p')
            car_item['brand'] = block.css('::text').extract_first()
            model = block.css('a::text').extract_first().split()[:-2]
            car_item['model'] = ' '.join(model)
            car_item['year'] = block.extract_first().split()[-1][:-4]
            price = car.css('.blocks_price').extract_first()
            car_item['price'] = ''.join(price.split()[4:-1])
            yield car_item

        next_page_selector = '.pages_nav a.pn_right::attr(href)'
        next_page = response.css(next_page_selector).extract_first()

        if next_page is not None:
            next_page = response.urljoin(next_page)
            yield scrapy.Request(next_page, callback=self.parse)
