from flask import Flask, request, jsonify
from sklearn.externals import joblib
import traceback
import pandas as pd
import numpy as np
import sys
from flask_cors import CORS
from flask_cors import cross_origin
app = Flask(__name__)
@app.route('/predict', methods=['POST'])
def predict():
    if lr:
        try:
            json_ = request.json
            print(json_)
            query = (pd.DataFrame(json_))

            q=np.array(['Pregnancies','Glucose','BloodPressure','SkinThickness','Insulin','BMI','DiabetesPedigreeFunction','Age'])
            q.reshape(1,-1)
            x=pd.DataFrame(columns=(q))
            x=x.append({'Pregnancies':query.Pregnancies[0],'Glucose':query.Glucose[0],'BloodPressure':query.BloodPressure[0],'SkinThickness':query.SkinThickness[0],'Insulin':query.Insulin[0],'BMI':query.BMI[0],'DiabetesPedigreeFunction':query.DiabetesPedigreeFunction[0],'Age':query.Age[0]},ignore_index=True)
            print(x)
            prediction = list(lr.predict(x))

            if prediction[0]==0:

                return("0")
                print("safe")
            
            else:

                return("1")
                print("danger")
                            
        except:

            return jsonify({'trace': traceback.format_exc()})
    else:
        print ('Train the model first')
        return ('No model here to use')

if __name__ == '__main__':
    try:
        port = int(sys.argv[1]) # This is for a command-line input
    except:
        port = 12345 # If you don't provide any port the port will be set to 12345

    lr = joblib.load("model.pkl") # Load "model.pkl"
    print ('Model loaded')

    @app.after_request

    def after_request(response):
        response.headers.add('Access-Control-Allow-Origin', '*')
        response.headers.add('Access-Control-Allow-Headers', 'Content-Type,Authorization')
        response.headers.add('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE')
        return response

    app.run(port=port, debug=True)

 