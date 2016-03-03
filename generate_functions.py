#!/usr/bin/python

import os,sys

functions = "func"
folder = "dummy_functions"
filename = "f"
class_name = "dummy_class"

class_filename = "class_f"
array_name = "\t$long_array_withlongname_with_integers"
array_init = array_name + " = array();\n"

def gen_functions(files=10, func=50, lines=100):
	global functions, folder, filename, array_init
	os.system("rm -rf "+ folder)
	os.system("mkdir " + folder)
	for i in range(files):
		fname = filename + str(i) + ".php"
		abs_path = os.getcwd()
		f = open(os.path.join(abs_path,folder,fname), 'w+')
		f.write('<?php\n')
		# for j in range(lines):
		# 	f.write('$var'+str(j)+' = ' + str(j) + ";\n")
		# 	f.write("DEFINE(" + "\'vvar" + str(i) + str(j) +"\', " + str(j) + ");\n")
		for j in range(func):
			head = "function " + functions + str(j) + str(i) + "() {\n" + array_init
			f.write(head)
			for k in range(lines):
				line = array_name + "[" + str(k) + "] = " + str(k) + ";\n"
				f.write(line)
			f.write("}\n")
			f.write(functions + str(j) + str(i) + "();\n")
		f.write('?>\n')
		f.close()

def gen_classes(files=10, classes=5, class_func=20, lines=100):
	global functions, folder, filename, array_init
	for i in range(files):
		fname = class_filename + str(i) + ".php"
		abs_path = os.getcwd()
		full_path = os.path.join(abs_path,folder,fname) 
		os.system("rm " + full_path + " &> /dev/null")
		f = open(full_path, 'w+')
		f.write('<?php\n')
		f.write('\n\nclass generic_class_' + fname[:-4] + ' { function generic_class_' + fname[:-4] + '() {} }\n\n')
		for c in range(classes):
			cname = fname[:-4] + "_" + class_name + str(i) + str(c)
			f.write("class " + cname + " extends generic_class_" + fname[:-4] + " {\n") # class cname {
			f.write("\tfunction " + cname + "() { } \n")
			for j in range(class_func):
				head = "function " + functions + str(j) + str(i) + "() {\n" + array_init
				f.write(head)
				for k in range(lines):
					line = array_name + "[" + str(k) + "] = " + str(k) + ";\n"
					f.write(line)
				f.write("}\n")

			f.write("}\n") # } for end of class declaration
		f.write('?>\n')
		f.close()

gen_functions()
gen_classes()

