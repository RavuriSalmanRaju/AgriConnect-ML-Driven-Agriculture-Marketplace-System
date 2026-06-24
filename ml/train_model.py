import pandas as pd
from sklearn.tree import DecisionTreeClassifier
import joblib

# Simple demo dataset (College project ki perfect)
data = {
    "temp":     [20, 22, 28, 30, 35, 38, 25, 27, 18, 16, 32, 29],
    "humidity": [60, 70, 80, 75, 50, 40, 85, 65, 55, 50, 45, 90],
    "rainfall": [200,180,250, 120, 30,  20, 300, 150, 80,  60,  25, 220],
    "crop": ["Paddy","Paddy","Paddy","Cotton","Millets","Groundnut",
             "Paddy","Cotton","Wheat","Wheat","Groundnut","Paddy"]
}

df = pd.DataFrame(data)

X = df[["temp", "humidity", "rainfall"]]
y = df["crop"]

model = DecisionTreeClassifier()
model.fit(X, y)

joblib.dump(model, "model.pkl")
print("✅ model.pkl created successfully")
