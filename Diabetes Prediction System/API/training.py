#Importing pandas library
import pandas as pd

#importing dataset
df=pd.read_csv('diabetes_new.csv')

#Importing random forest classifier
from sklearn.ensemble import RandomForestClassifier

#load model
rf = RandomForestClassifier(n_estimators = 108, random_state = 5)

#drop target column
X = df.drop('Outcome',axis=1)

#get target column
y=df.Outcome

#split model into testing and training
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X,y,test_size=0.2,random_state = 5)

#apply model
model=rf.fit(X_train, y_train)

#import joblib to save model
from sklearn.externals import joblib

#save model
joblib.dump(model, 'model.pkl')
print("Model dumped!")