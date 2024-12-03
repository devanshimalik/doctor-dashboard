import pandas as pd
from sklearn.cluster import KMeans
import mysql.connector

# Load data from MySQL database
connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="hms",
    port=3307
)
query = "SELECT * FROM patient"
patients_df = pd.read_sql(query, connection)

# Example Analysis: Clustering patients by age and diagnosis
kmeans = KMeans(n_clusters=3)
patients_df['Cluster'] = kmeans.fit_predict(patients_df[['age', 'diagnosis_code']])

# Save clustering results back to the database
for index, row in patients_df.iterrows():
    cursor = connection.cursor()
    cursor.execute("UPDATE patient SET cluster=%s WHERE id=%s", (row['Cluster'], row['id']))
connection.commit()
