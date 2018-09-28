### installation guide :- 

```sudo docker-compose build```

```sudo docker-compose up -d```

```sudo docker-compose exec php bash```

```composer update```

###### apply improt data migration

``` php yii mongodb-migrate```

```exit```

###### apply 2dsphere index on location ''' have issue with appliying it from yii migration '''

```sudo docker-compose exec mongo bash```

```mongo```

```use hnugrig```

```db.resturants.createIndex({loc:"2dsphere"})```

```exit```


##### add this url to your machine hosts 

```hungrig.se```



##### running the api test

```codecept run api```



##### test url

```
hungrig.se:8000/api/resturants/search?name=Thaimidd&city=Stockholm&cuisine=Thai&freetext=Thaimiddag&lon=13.000005&lat=55.601364
```
