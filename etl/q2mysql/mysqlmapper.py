#!/usr/bin/python
import sys
import json

monthlist = ["Jan","Feb","Mar","Apr", "May", "Jun", "Jul", "Aug", "Sep","Nov","Dec"];

def main(argv):
	for line in sys.stdin:
		line = line.strip()
		r = json.loads(line)
		time = r["created_at"]
		timeArray = time.split(' ')
		month = str(monthlist.index(timeArray[1]) + 1)
		if (len(month) == 1):
			month = '0' + month

		tweet_time = timeArray[-1] + '-' + month + '-' + timeArray[2] + ' ' + timeArray[3]
		tweetid = r["id_str"]
		userid =  r["user"]["id_str"]
		combineId = userid + '+' + tweet_time
		output = combineId + ',' + tweetid
		print output

if __name__ == "__main__":
	main(sys.argv)
