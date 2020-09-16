# -*- coding: utf-8 -*-
import cv2
import sys

args = sys.argv

cascade = cv2.CascadeClassifier("haarcascade_frontalface_alt.xml")

img = cv2.imread(args[1])
img_gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)

face_list = cascade.detectMultiScale(img_gray, minSize=(150,150))

if len(face_list) > 0:
	for (x, y, w, h) in face_list:
		print("顔の座標=",x, y, w, h)
		cv2.rectangle(img,(x, y), (x+w, y+h), (0, 0, 255), thickness=20)
else:
	print("no")

#cv2.imshow("face", img)
#cv2.waitKey(0)
#cv2.destroyAllWindows()