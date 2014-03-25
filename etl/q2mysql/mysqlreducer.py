#!/usr/bin/python
import sys

def main(argv):
	# input comes from STDIN
	for line in sys.stdin:
		print line

if __name__ == "__main__":
	main(sys.argv)
