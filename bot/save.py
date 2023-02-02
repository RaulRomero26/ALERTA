import os

def saveperson(rows):
    print('ANTES DE ABRIR EL ARCHIVO FUNCION DE SAVE: ',rows)
    if os.path.exists("rowspersona.txt"):
        os.remove("rowspersona.txt")
        file1 = open("rowspersona.txt","w+")
        file1.write(rows)
        file1.close()

def readperson():
    file1 = open("rowspersona.txt","r")
    rows = file1.read()
    file1.close()
    print('FUNCION READ DE SAVE PY :',rows)
    return rows

def savevehicle(rows):
    print('ANTES DE ABRIR EL ARCHIVO FUNCION DE SAVE VEHICULOS: ',rows)
    if os.path.exists("rowsvehiculo.txt"):
        os.remove("rowsvehiculo.txt")
        file1 = open("rowsvehiculo.txt","w+")
        file1.write(rows)
        file1.close()

def readvehicle():
    file1 = open("rowsvehiculo.txt","r")
    rows = file1.read()
    file1.close()
    print('FUNCION READ DE SAVE PY VEHICULOS:',rows)
    return rows


# def main():
#     for i in range(10):
#         print(i)
#         a = save(str(i))
#         time.sleep(5)
#         read()


# inicio = main()