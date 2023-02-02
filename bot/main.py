
import os
from discord.ext import commands, tasks
from dotenv import load_dotenv

from conexion import basepersona, basevehiculo

load_dotenv()
TOKEN = os.getenv('DISCORD_TOKEN')

bot = commands.Bot(command_prefix='!') #Prefijo del bot

@bot.command(name='m') #Funcion que realizara la suma entre dos numeros enteros
async def multiplicar(ctx, num1,num2):
    response = int(num1)*int(num2)
    await ctx.send(response)

@tasks.loop(seconds=15)
async def persona():
    channel = bot.get_channel(987008022578606152)
    print(channel)
    data = basepersona()
    datav = basevehiculo()
    #print(data)
    #print(datav)
    if data != None:
        await channel.send("\n\n**`---------------INCIDENCIA EN PERSONA---------------`**\n"+data)
    if datav != None:
        await channel.send("\n\n**`---------------INCIDENCIA EN VEHICULOS---------------`**\n"+datav)

@bot.event
async def on_ready():
    persona.start()

bot.run(TOKEN)