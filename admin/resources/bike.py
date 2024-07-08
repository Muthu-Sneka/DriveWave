import shutil
import uuid
from fastapi import APIRouter, Depends, File, HTTPException, FastAPI, Request, Form, UploadFile
from fastapi.encoders import jsonable_encoder
from fastapi.templating import Jinja2Templates
from fastapi.responses import JSONResponse, RedirectResponse
from sqlalchemy.orm import Session
from config.base_config import BaseConfig
from fastapi.staticfiles import StaticFiles
from datetime import  datetime,date, timedelta
from models import get_db,models
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from admin.resources.utils import create_access_token
from starlette.middleware.sessions import SessionMiddleware
from Externalapi import list_cities_in_india,get_place
from jose import jwt, JWTError
import json
import requests
current_datetime = datetime.utcnow()
router = APIRouter()
templates = Jinja2Templates(directory="admin/templates")
router.mount("/admin/templates", StaticFiles(directory="admin/templates"), name="templates")







@router.get("/bike")
def bike(request:Request,db:Session=Depends(get_db)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:    
           bikes=db.query(models.Bikes).filter(models.Bikes.Status=="Active").all()
           return templates.TemplateResponse('bike.php', context={'request': request,'bikes':bikes,"cities":list_cities_in_india()})
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)



@router.get("/add_bikes")
def bike(request:Request):  
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else: 
           return templates.TemplateResponse('add_bike.php', context={'request': request,"cities":list_cities_in_india()})
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)




@router.post("/add_bike")
def addBike(request:Request,db:Session=Depends(get_db),bikename:str=Form(...),bikefuel:str=Form(...),costperhr:str=Form(...),vehicletype:str=Form(...),cityname:str=Form(...),location:str=Form(...),bimage1:UploadFile=File(...),bimage2:UploadFile=File(...),bimage3:UploadFile=File(...),bimage4:UploadFile=File(...),starttype:str=Form(...),bikecc:str=Form(...),bikemileage:str=Form(...)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
             
            count=db.query(models.Bikes).all()
            
            c=len(count)+1
            pid="BIK"+str(c)
            file_type = bimage1.content_type
            extention = file_type.split('/')[-1]
            image_file1 = str(uuid.uuid4())+ '.' + str(extention)
            image_file2 = str(uuid.uuid4())+ '.' + str(extention)
            image_file3 = str(uuid.uuid4())+ '.' + str(extention)
            image_file4 = str(uuid.uuid4())+ '.' + str(extention)
            
            file_location = f"admin/templates/bike_images/{image_file1}"
            with open(file_location, "wb+") as file_object:
                shutil.copyfileobj(bimage1.file, file_object)
                
            file_location1 = f"admin/templates/bike_images/{image_file2}"
            with open(file_location1, "wb+") as file_object:
                shutil.copyfileobj(bimage2.file, file_object)
                
            file_location2 = f"admin/templates/bike_images/{image_file3}"
            with open(file_location2, "wb+") as file_object:
                shutil.copyfileobj(bimage3.file, file_object)
                
            file_location3 = f"admin/templates/bike_images/{image_file4}"
            with open(file_location3, "wb+") as file_object:
                shutil.copyfileobj(bimage4.file, file_object)

            db_data=models.Bikes(Bikeid=pid,Bikename_model=bikename,Fueltype=bikefuel,CostperHR=costperhr,Vehicletype=vehicletype,Cityname=cityname,Location=location,Image1=image_file1,Image2=image_file2,Image3=image_file3,Image4=image_file4,Starttype=starttype,Ccofthebike=bikecc,Nooftrips=0,Mileage=bikemileage,Availablestatus="Avalible",Status="Active",Created_at=current_datetime)
            db.add(db_data)
            db.commit()
            error = "Done"
            json_compatible_item_data = jsonable_encoder(error)
            return JSONResponse(content=json_compatible_item_data)
            # else:
            #     error = "Already this Product Exist"
            #     json_compatible_item_data = jsonable_encoder(error)
            #     return JSONResponse(content=json_compatible_item_data)        
        
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)
       # raise HTTPException(status_code=401,detail="Unauthorized")
       

@router.put("/view_bike/{id}")
async def view_bike(id:int,request:Request,db:Session=Depends(get_db)):
    
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            vbike=db.query(models.Bikes).filter(models.Bikes.id==id,models.Bikes.Status=="Active").first()
           # vbike.location= get_place(vbike.Cityname,None,None)
            json_compatible_item_data = jsonable_encoder(vbike)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)


@router.put("/edit_bike/{id}")
async def view_bike(id:int,request:Request,db:Session=Depends(get_db)):
    
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            vbike=db.query(models.Bikes).filter(models.Bikes.id==id,models.Bikes.Status=="Active").first()
            vbike.location= get_place(vbike.Cityname,None,None)
            json_compatible_item_data = jsonable_encoder(vbike)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)
        #raise HTTPException(status_code=401,detail="Unauthorized")
        
    
@router.post("/update_bike")
def update_bike(request:Request,db:Session=Depends(get_db),edit_id:str=Form(...),edit_bikename:str=Form(...),edit_bikefuel:str=Form(...),edit_costperhr:str=Form(...),edit_vehicletype:str=Form(...),edit_city:str=Form(...),edit_location:str=Form(...),edit_starttype:str=Form(...),edit_bikecc:str=Form(...),edit_bikemileage:str=Form(...),edit_bikimg1:UploadFile=File(...),edit_bikimg2:UploadFile=File(...),edit_bikimg3:UploadFile=File(...),edit_bikimg4:UploadFile=File(...),):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
        
            file_type = edit_bikimg1.content_type
            extention = file_type.split('/')[-1]
            image_file1 = str(uuid.uuid4())+ '.' + str(extention)
            image_file2 = str(uuid.uuid4())+ '.' + str(extention)
            image_file3 = str(uuid.uuid4())+ '.' + str(extention)
            image_file4 = str(uuid.uuid4())+ '.' + str(extention)
            
            file_location = f"admin/templates/bike_images/{image_file1}"
            with open(file_location, "wb+") as file_object:
                shutil.copyfileobj(edit_bikimg1.file, file_object)
                
            file_location1 = f"admin/templates/bike_images/{image_file2}"
            with open(file_location1, "wb+") as file_object:
                shutil.copyfileobj(edit_bikimg2.file, file_object)
                
            file_location2 = f"admin/templates/bike_images/{image_file3}"
            with open(file_location2, "wb+") as file_object:
                shutil.copyfileobj(edit_bikimg3.file, file_object)
                
            file_location3 = f"admin/templates/bike_images/{image_file4}"
            with open(file_location3, "wb+") as file_object:
                shutil.copyfileobj(edit_bikimg4.file, file_object)
            
            db.query(models.Bikes).filter(models.Bikes.id==edit_id).update({"Bikename_model": edit_bikename,"Fueltype":edit_bikefuel,"CostperHR": edit_costperhr,"Vehicletype": edit_vehicletype,"Cityname": edit_city,"Location": edit_location,"Image1": image_file1,"Image2":image_file2,"Image3":image_file3, "Image4":image_file4,"Starttype":edit_starttype,"Ccofthebike":edit_bikecc,"Mileage": edit_bikemileage})
            db.commit()
            error = "Done"
            json_compatible_item_data = jsonable_encoder(error)
            return JSONResponse(content=json_compatible_item_data)
            # else:
            #     error = "Already this Product Exist"
            #     json_compatible_item_data = jsonable_encoder(error)
            #     return JSONResponse(content=json_compatible_item_data)        
        
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)
        #raise HTTPException(status_code=401,detail="Unauthorized")




@router.put("/delete_bike/{id}")
def delete_bike(id:int,request:Request,db:Session=Depends(get_db)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:    
            db.query(models.Bikes).filter(models.Bikes.id==id).update({"Status":"Inactive"})
            db.commit()
            error = "Done"
            json_compatible_item_data = jsonable_encoder(error)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)


@router.put("/fetch_location/{city}")
def fetch_location(city:str,request:Request):
    
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            location=get_place(city,None,None);
            json_compatible_item_data = jsonable_encoder(location)
            return JSONResponse(content=json_compatible_item_data)
    except:
        return RedirectResponse("/admin/login", status_code=303)
