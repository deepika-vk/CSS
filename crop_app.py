import joblib
from flask import Flask, render_template, request, redirect, session
from peewee import *

db = SqliteDatabase("database.db")

class User(Model):
    class Meta:
        database = db
    username = CharField()
    password = CharField()
    email = CharField()
    age = CharField()

db.create_tables([User])

app = Flask(__name__, template_folder="", static_folder="")


app.secret_key = "jgfsdhjg"

@app.route('/')
def home():
    return render_template('home.php')

@app.route('/Predict')
def prediction():
    return render_template('Index.html')

@app.route('/form', methods=["POST"])
def brain():
    Nitrogen=float(request.form['Nitrogen'])
    Phosphorus=float(request.form['Phosphorus'])
    Potassium=float(request.form['Potassium'])
    Temperature=float(request.form['Temperature'])
    Humidity=float(request.form['Humidity'])
    Ph=float(request.form['ph'])
    Rainfall=float(request.form['Rainfall'])
     
    values=[Nitrogen,Phosphorus,Potassium,Temperature,Humidity,Ph,Rainfall]
    
    if Ph>0 and Ph<=14 and Temperature<100 and Humidity>0:
        joblib.load('crop_app','r')
        model = joblib.load(open('crop_app','rb'))
        arr = [values]
        acc = model.predict(arr)
        print(acc, "acc")
        return render_template('prediction.html', prediction=str(acc))
    else:
        return "Sorry...  Error in entered values in the form Please check the values and fill it again"

@app.route("/register.html", methods=["GET", "POST"])
def register():
    message = None
    if request.method == "POST":
        user = User.select().where(User.email==request.form.get("email")).first()
        if not user:
            User.create(
                username = request.form.get("username"),
                password= request.form.get("password"),
                email = request.form.get("email"),
                age = request.form.get("age"),
            )
            message = "You are registerd"
        else:
            message = "Please chek your details"

    return render_template("register.html", msg=message)

@app.route("/login.html", methods=["POST", "GET"])
def login():
    msg = None
    if request.method == "POST":
        u = request.form.get("username")
        p = request.form.get("password")
        if User.select().where(
            User.username == u
        ).where(
            User.password ==p
        ):
            session["login"] = True
            msg = "You are loggined"
        else:
            msg = "Invalid username or password"
    return render_template("login.html", msg=msg)



if __name__ == '__main__':
    app.run(debug=True, host="0.0.0.0")















