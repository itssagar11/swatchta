import csv
import base64
import os
import boto3
from os.path import dirname, join

def main(data):
    try:
        dataV = base64.b64decode(data)
    except:
        return "-1"
    os.environ['AWS_DEFAULT_REGION'] = 'us-west-2'
    client = boto3.client('rekognition',
                          aws_access_key_id = 'AKIAUBRS5A6I2ED55HNY',
                          aws_secret_access_key = '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')
    kms = boto3.client('kms', region_name='us-west-2')
    try:
        source_bytes = bytes(dataV)
    except:
        return "-1"
    try:
        response = client.detect_labels(Image = {'Bytes': source_bytes},
                                        MaxLabels=5)
    except:
        return "-1"
    i = {}
    for i in response['Labels']:
        if i['Name'] == "Trash" and int(i['Confidence']) > 50:
            return response
    return "-1"
