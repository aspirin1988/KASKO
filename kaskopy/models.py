# coding: utf-8
from peewee import *

db = MySQLDatabase('centras', host='localhost', user='root', password='root', charset='utf8')

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

    class Meta:
        database = db
        db_table = 'raw_datas'
