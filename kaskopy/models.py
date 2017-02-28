# coding: utf-8
from peewee import *
from datetime import datetime

db = MySQLDatabase('centras', host='localhost', user='centras', password='123456', charset='utf8')

#db = SqliteDatabase('kaskopy.db')


class Car(Model):
    mark = CharField()
    model = CharField()
    year = IntegerField()

    class Meta:
        database = db
        db_table = 'сar_lists'


class RawData(Model):
    price = IntegerField()
    car = ForeignKeyField(Car)
    created_at = DateTimeField()
    updated_at = DateTimeField()

    class Meta:
        database = db
        db_table = 'raw_datas'

    def save(self, *args, **kwargs):
        if not self.created_at:
            self.created_at = datetime.now()

        self.updated_at = datetime.now()
        return super(RawData, self).save(*args, **kwargs)
