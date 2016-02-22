#!/usr/bin/python

import sys
FILENAME = "keys.php"

def keygen(array_size=1000000):
	global FILENAME
	f = open(FILENAME, 'w')
	f.write('<?php\n$KEYS = array(')
	size = int(array_size)
	for i in range(size):
		ksize = 16 + (i%32);
		s = "\"q" + str(i)
		ndiez = "#" * ksize
		s += ndiez + "\""
		f.write(s)
		if i < size - 1:
			f.write(',\n');
		else:
			f.write(');\n');
	f.write('?>\n')
	f.close();
keygen(sys.argv[1]);


