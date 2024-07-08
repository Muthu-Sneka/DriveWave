import shutil
from typing import List
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
current_datetime = datetime.utcnow()
router = APIRouter()
templates = Jinja2Templates(directory="admin/templates")
router.mount("/admin/templates", StaticFiles(directory="admin/templates"), name="templates")


@router.get("/car")
def bike(request:Request,db:Session=Depends(get_db)):   
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            
            Cars=db.query(models.Cars).filter(models.Cars.Status=="Active").all()
            return templates.TemplateResponse('car.php', context={'request': request,'cars':Cars,"cities":list_cities_in_india()})
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)
       # raise HTTPException(status_code=401,detail="Unauthorized")



@router.get("/add_cars")
def bike(request:Request):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:   
            return templates.TemplateResponse('add_cars.php', context={'request': request,"cities":list_cities_in_india()})
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)




@router.post("/add_car")
def addBike(request:Request,db:Session=Depends(get_db),carname:str=Form(...),carfuel:str=Form(...),costperhr:str=Form(...),vehicletype:str=Form(...),cityname:str=Form(...),location:str=Form(...),cimage1:UploadFile=File(...),cimage2:UploadFile=File(...),cimage3:UploadFile=File(...),cimage4:UploadFile=File(...),transmission:str=Form(...),seats:str=Form(...),others:str=Form(...)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            others=list(others.split(","))
             
            count=db.query(models.Cars).all()
            
            c=len(count)+1
            pid="CAR"+str(c)
            file_type = cimage1.content_type
            extention = file_type.split('/')[-1]
            image_file1 = str(uuid.uuid4())+ '.' + str(extention)
            image_file2 = str(uuid.uuid4())+ '.' + str(extention)
            image_file3 = str(uuid.uuid4())+ '.' + str(extention)
            image_file4 = str(uuid.uuid4())+ '.' + str(extention)
            
            file_location = f"admin/templates/car_images/{image_file1}"
            with open(file_location, "wb+") as file_object:
                shutil.copyfileobj(cimage1.file, file_object)
                
            file_location1 = f"admin/templates/car_images/{image_file2}"
            with open(file_location1, "wb+") as file_object:
                shutil.copyfileobj(cimage2.file, file_object)
                
            file_location2 = f"admin/templates/car_images/{image_file3}"
            with open(file_location2, "wb+") as file_object:
                shutil.copyfileobj(cimage3.file, file_object)
                
            file_location3 = f"admin/templates/car_images/{image_file4}"
            with open(file_location3, "wb+") as file_object:
                shutil.copyfileobj(cimage4.file, file_object)

            db_data=models.Cars(Carid=pid,Carname_model=carname,Fueltype=carfuel,CostperHR=costperhr,Vehicletype=vehicletype,Cityname=cityname,Location=location,Image1=image_file1,Image2=image_file2,Image3=image_file3,Image4=image_file4,Transmission=transmission,Seats=seats,Others=jsonable_encoder(others),Nooftrips=0,Availablestatus="Avalible",Status="Active",Created_at=current_datetime)
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
       

@router.put("/view_car/{id}")
def view_bike(id:int,request:Request,db:Session=Depends(get_db)):
    
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            vcar=db.query(models.Cars).filter(models.Cars.id==id,models.Cars.Status=="Active").first()
            #vcar.location= get_place(vcar.Cityname,None,None)
            json_compatible_item_data = jsonable_encoder(vcar)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
            raise HTTPException(status_code=401,detail="Unauthorized")
        #raise HTTPException(status_code=401,detail="Unauthorized")


@router.put("/edit_car/{id}")
def view_bike(id:int,request:Request,db:Session=Depends(get_db)):
    
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            vcar=db.query(models.Cars).filter(models.Cars.id==id,models.Cars.Status=="Active").first()
            vcar.location= get_place(vcar.Cityname,None,None)
            json_compatible_item_data = jsonable_encoder(vcar)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
            raise HTTPException(status_code=401,detail="Unauthorized")
        
    
@router.post("/update_car")
def update_car(request:Request,db:Session=Depends(get_db),edit_id:str=Form(...),edit_carname:str=Form(...),edit_carfuel:str=Form(...),edit_costperhr:str=Form(...),edit_vehicletype:str=Form(...),edit_city:str=Form(...),edit_location:str=Form(...),edit_transmission:str=Form(...),edit_seats:str=Form(...),others:str=Form(...),edit_img1:UploadFile=File(...),edit_img2:UploadFile=File(...),edit_img3:UploadFile=File(...),edit_img4:UploadFile=File(...),):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            others=list(others.split(","))
            file_type = edit_img1.content_type
            extention = file_type.split('/')[-1]
            image_file1 = str(uuid.uuid4())+ '.' + str(extention)
            image_file2 = str(uuid.uuid4())+ '.' + str(extention)
            image_file3 = str(uuid.uuid4())+ '.' + str(extention)
            image_file4 = str(uuid.uuid4())+ '.' + str(extention)
            
            file_location = f"admin/templates/car_images/{image_file1}"
            with open(file_location, "wb+") as file_object:
                shutil.copyfileobj(edit_img1.file, file_object)
                
            file_location1 = f"admin/templates/car_images/{image_file2}"
            with open(file_location1, "wb+") as file_object:
                shutil.copyfileobj(edit_img2.file, file_object)
                
            file_location2 = f"admin/templates/car_images/{image_file3}"
            with open(file_location2, "wb+") as file_object:
                shutil.copyfileobj(edit_img3.file, file_object)
                
            file_location3 = f"admin/templates/car_images/{image_file4}"
            with open(file_location3, "wb+") as file_object:
                shutil.copyfileobj(edit_img4.file, file_object)
            
            db.query(models.Cars).filter(models.Cars.id==edit_id).update({"Carname_model": edit_carname,"Fueltype":edit_carfuel,"CostperHR": edit_costperhr,"Vehicletype": edit_vehicletype,"Cityname": edit_city,"Location": edit_location,"Image1": image_file1,"Image2":image_file2,"Image3":image_file3, "Image4":image_file4,"Transmission":edit_transmission,"Seats":edit_seats,"Others": jsonable_encoder(others)})
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
        

@router.put("/delete_car/{id}")
def delete_car(id:int,request:Request,db:Session=Depends(get_db)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:    
            db.query(models.Cars).filter(models.Cars.id==id).update({"Status":"Inactive"})
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