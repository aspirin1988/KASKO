# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy
from kaskopy.models import Car, RawData


class CarItem(scrapy.Item):
    brand = scrapy.Field()
    model = scrapy.Field()
    year = scrapy.Field()
    price = scrapy.Field()

    def save(self):
        kwargs = {
            'brand': self['brand'],
            'model': self['model'],
            'year': self['year']
        }
        car = Car.get_or_create(**kwargs)
        RawData.create(price=self['price'], car=car)
