import sys
import os
import joblib
import warnings

# ✅ warnings hide
warnings.filterwarnings("ignore")

BASE_DIR = os.path.dirname(os.path.abspath(__file__))
model_path = os.path.join(BASE_DIR, "model.pkl")

temp = float(sys.argv[1])
humidity = float(sys.argv[2])
rainfall = float(sys.argv[3])

model = joblib.load(model_path)

pred = model.predict([[temp, humidity, rainfall]])[0]

# ✅ only crop name output
print(pred)
