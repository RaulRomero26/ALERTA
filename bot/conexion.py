import mysql.connector
from save import saveperson, readperson, savevehicle, readvehicle

def basepersona():
    conexion = mysql.connector.connect(user='root', host='localhost', database='alertas', port='3306')

    print(conexion)
    try: 
        rows = readperson()
        #print('LEIDOS DEL ARCHIVO: ', rows)
        result = ''

        if conexion.is_connected():
            #print("Conexion exitosa")
            cursor = conexion.cursor()
            #seleccion de la db
            cursor.execute("SELECT database();")
            registro = cursor.fetchone()
            #print("Conectado a la base de datos: ", registro)

            cursor.execute("SELECT COUNT(Id) as count_datos FROM coincidencias;")
            renglones = cursor.fetchone() #obteno cuantos renglones hay en la tabla guardar y posterior comparacion
            print(' RENGLONES DIRECTO DE DB: ',renglones[0]) 
    
        print('ROWSDB: ', renglones[0], 'ROWS FILE: ', rows)

        if str(renglones[0]) != str(rows):
            renglonesimp= renglones[0]-int(rows)
             #obtengo los ultimos registros agregados
            cadenasql = "select * from coincidencias order by Id desc limit "+str(renglonesimp)
            cursor.execute(cadenasql)
            resultados = cursor.fetchall()
            #print(resultados)
            cadena = ''
            for fila in resultados:
                cadena+='\n **Alerta Persona(s):** '+'\n**Nombre:** '+ str(fila[1])+'\n **Apellido Paterno:** '+  str(fila[2])+'\n **Apellido Materno:** '+  str(fila[3])+'\n**Alias:** '+  str(fila[4])+'\n**Banda:** '+  str(fila[5])+'\n**Delitos Asociados:** '+  str(fila[6])+'\n**Folio:** '+  str(fila[7])+'\n **Observaciones:** '+  str(fila[9])+'\n'
                #print(cadena)
                if str(fila[5])!='S/D':
                    cadenasql = "select * from buscadosvh where Banda = "+"'"+str(fila[5])+"'"
                    cursor.execute(cadenasql)
                    resultadosvehiculos = cursor.fetchall()
                    for fila in resultadosvehiculos:
                        cadena+='\n**Vehculo Asociado por Banda:**\n'
                        cadena+='**Placa:** '+  str(fila[1])+'\n**NIV:** '+  str(fila[2])+'\n **Vehiculo:** '+  str(fila[3])+'\n **Banda:** '+  str(fila[4])+'\n **Delito:** '+  str(fila[5])+'\n **Observaciones:** '+  str(fila[7])+'\n'
            cadena+='**`---------------FIN MENSAJE---------------`**'
            saveperson(str(renglones[0]))
            print(cadena)
            return cadena
    except Exception as e:
        print("Error durante la conexion: ", e)
    finally:
        if conexion.is_connected():
            conexion.close()
            print("La conexion ha finalizado")

def basevehiculo():
    conexion = mysql.connector.connect(user='root', host='localhost', database='alertas', port='3306')

    print(conexion)
    try: 
        rows = readvehicle()
        #print('LEIDOS DEL ARCHIVO: ', rows)
        result = ''

        if conexion.is_connected():
            #print("Conexion exitosa")
            cursor = conexion.cursor()
            #seleccion de la db
            cursor.execute("SELECT database();")
            registro = cursor.fetchone()
            #print("Conectado a la base de datos: ", registro)

            cursor.execute("SELECT COUNT(Id) as count_datos FROM coincidenciasvh;")
            renglones = cursor.fetchone() #obteno cuantos renglones hay en la tabla guardar y posterior comparacion
            print(' RENGLONES DIRECTO DE DB: ',renglones[0]) 
    
        print('ROWSDB: ', renglones[0], 'ROWS FILE: ', rows)

        if str(renglones[0]) != str(rows):
            renglonesimp= renglones[0]-int(rows)
             #obtengo los ultimos registros agregados
            cadenasql = "select * from coincidenciasvh order by Id desc limit "+str(renglonesimp)
            cursor.execute(cadenasql)
            resultados = cursor.fetchall()
            #print(resultados)
            cadena = ''
            for fila in resultados:
                cadena+='\n **Coincidencia Vehiculos:** '+'\n **Placa:** '+  str(fila[1])+'\n**NIV:** '+  str(fila[2])+'\n **Vehiculo:** '+  str(fila[3])+'\n **Banda:** '+  str(fila[4])+'\n **Delito:** '+  str(fila[5])+'\n **Observaciones:** '+  str(fila[7])+'\n'
                #print(cadena)
                if str(fila[4])!='S/D':
                    cadenasql = "select * from buscados where Banda = "+"'"+str(fila[4])+"'"
                    cursor.execute(cadenasql)
                    resultadosvehiculos = cursor.fetchall()
                    for fila in resultadosvehiculos:
                        cadena+='\n**Persona Asociada por Banda:**\n'
                        cadena+='\n **Alerta Persona(s):** '+'\n**Nombre:** '+ str(fila[1])+'\n **Apellido Paterno:** '+  str(fila[2])+'\n **Apellido Materno:** '+  str(fila[3])+'\n**Alias:** '+  str(fila[4])+'\n**Banda:** '+  str(fila[5])+'\n**Delitos Asociados:** '+  str(fila[6])+'\n**Folio:** '+  str(fila[7])+'\n **Observaciones:** '+  str(fila[9])+'\n'
            cadena+='**`---------------FIN MENSAJE---------------`**'
            savevehicle(str(renglones[0]))
            print(cadena)
            return cadena
    except Exception as e:
        print("Error durante la conexion: ", e)
    finally:
        if conexion.is_connected():
            conexion.close()
            print("La conexion ha finalizado")