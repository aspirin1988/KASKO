# coding: utf-8
from peewee import *

# db = MySQLDatabase('dbname', host='mysql', user='dbuse',
#                    password='dbpass', charset='utf8')

db = SqliteDatabase('kaskopy.db')


class Car(Model):
    brand = CharField()
    model = CharField()
    year = IntegerField()

    class Meta:
        database = db
        db_table = 'cars'


class RawData(Model):
    price = IntegerField()
    car = ForeignKeyField(Car)

    class Meta:
        database = db
        db_table = 'raw_datas'
