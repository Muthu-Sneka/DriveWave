from sqlalchemy import Boolean, Column, ForeignKey,  String, DateTime, LargeBinary
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy import Boolean, Column, ForeignKey, Integer, String, Time,Date,DateTime,BLOB, JSON,Float
from sqlalchemy.orm import relationship
from datetime import date, datetime
from models import engine
#import bcrypt
import uuid
from sqlalchemy.dialects.postgresql import UUID
from sqlalchemy.ext.declarative import declarative_base

Base = declarative_base()
Base.metadata.bind = engine

class User(Base):
    __tablename__ = 'users'
    
    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    Username=Column(String(255),nullable=False)
    Emailid=Column(String(255),nullable=False)
    Phonenumber=Column(String(255),nullable=False)
    Password=Column(String(255),nullable=False)
    
    
    #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)

class Query(Base):
    __tablename__ = 'query'
    
    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    QueryId=Column(String(255),nullable=False)
    Emailid=Column(String(255),nullable=False)
    Querycontent=Column(String(355),nullable=False)
  
    
    
    #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)


class Admin(Base):
    __tablename__='admin'

    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    Username=Column(String(255),nullable=False)
    Password=Column(String(255),nullable=False)


    #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)

class Bikes(Base):
    __tablename__='bikes'
    
    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    Bikeid=Column(String(255),nullable=False)
    Bikename_model=Column(String(255),nullable=False)
    Fueltype=Column(String(255),nullable=False)
    CostperHR=Column(Integer,nullable=False)
    Vehicletype=Column(String(255),nullable=False)
    Cityname=Column(String(255),nullable=False)
    Location=Column(String(255),nullable=False)
    Image1=Column(String(255),nullable=False)
    Image2=Column(String(255),nullable=False)
    Image3=Column(String(255),nullable=False)
    Image4=Column(String(255),nullable=False)
    Starttype=Column(String(255),nullable=False)
    Ccofthebike=Column(Integer,nullable=False)
    Mileage=Column(Integer,nullable=False)
    Nooftrips=Column(Integer,nullable=False)
    Availablestatus=Column(String(255),nullable=False)
    
    
    #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)


class Cars(Base):
    
    __tablename__ = 'cars'
    
    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    Carid=Column(String(255),nullable=False)
    Carname_model=Column(String(255),nullable=False)
    Fueltype=Column(String(255),nullable=False)
    CostperHR=Column(Integer,nullable=False)
    Vehicletype=Column(String(255),nullable=False)
    Cityname=Column(String(255),nullable=False)
    Location=Column(String(255),nullable=False)
    Image1=Column(String(255),nullable=False)
    Image2=Column(String(255),nullable=False)
    Image3=Column(String(255),nullable=False)
    Image4=Column(String(255),nullable=False)
    Transmission=Column(String(255),nullable=False)
    Seats=Column(String(255),nullable=False)
    Others=Column(JSON,nullable=False)
    Nooftrips=Column(Integer,nullable=False)
    Availablestatus=Column(String(255),nullable=False)
    
     #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)



class Rentrequest(Base):
    
    __tablename__='rentrequest'
    
    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    BookingId=Column(String(255),nullable=False) 
    Username=Column(String(255),nullable=False)
    Emailid=Column(String(255),nullable=False)
    VehicleId=Column(String(255),nullable=False)
    Pickuptime=Column(String(255),nullable=False)
    Droptime=Column(String(255),nullable=False)
    Totalcost=Column(String(255),nullable=False)
    PaymentId=Column(String(255),nullable=False)
    City=Column(String(255),nullable=False)
    Location=Column(String(255),nullable=False)
    TimeofpaymentCompletion=Column(String(255),nullable=False)
    
    
    
    #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)

class Feedback(Base):
    
    __tablename__ = 'feedback'
    id=Column(Integer,index=True,autoincrement=True, primary_key=True,nullable=False)
    Feedbackid=Column(String(255),nullable=False)
    Username=Column(String(255),nullable=False)
    Vehicleid=Column(String(255),nullable=False)
    Noofstarts=Column(Integer,nullable=False)
    Review_Content=Column(String(255),nullable=False)
    
    #comman columns
    Status=Column(String(100),nullable=False)
    Created_at=Column(String(100),nullable=False)
    
    
    

Base.metadata.create_all(bind=engine)