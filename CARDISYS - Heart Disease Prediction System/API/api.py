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

            q=np.array(['Age','Sex','Cp','trestbps','chol','fbs','restecg','thalach','exang','oldpeak','slope','ca','thal'])
            q.reshape(1,-1)
            x=pd.DataFrame(columns=(q))
            x=x.append({'Age':query.Age[0],'Sex':query.Sex[0],'Cp':query.Cp[0],'trestbps':query.trestbps[0],'chol':query.chol[0],'fbs':query.fbs[0],'restecg':query.restecg[0],'thalach':query.thalach[0],'exang':query.exang[0],'oldpeak':query.oldpeak[0],'slope':query.slope[0],'ca':query.ca[0],'thal':query.thal[0]},ignore_index=True)
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

 