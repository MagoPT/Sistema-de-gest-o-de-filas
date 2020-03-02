#!/usr/bin/env python
#Fonte https://websockets.readthedocs.io/en/stable/intro.html
# WS server example that synchronizes state across clients

import asyncio
import json
import logging
import websockets


logging.basicConfig()

'''
especialidades aceites

as 4 especialidades aceites são:

0 - Geral
1 - Oftalmologista
2 - otorrinolaringologista
3 - dentista
matriz = [especialidade,medico, n_senha, senha_atual, status]
'''

ip = "192.168.1.85"
ordem = []
STATE = {"total_geral": 0, "atual_geral":0,"total_oftalmologista": 0, "atual_oftalmologista":0,"total_cardiologia": 0, "atual_cardiologia":0,"total_psicologia": 0, "atual_psicologia":0,"status":'done',"som":"","last":"","ordem":ordem}

USERS = set()


def state_event():
    return json.dumps({"type": "state", **STATE})


def users_event():
    return json.dumps({"type": "users", "count": len(USERS)})


async def notify_state():
    if USERS:  # asyncio.wait doesn't accept an empty list
        message = state_event()
        await asyncio.wait([user.send(message) for user in USERS])


async def notify_users():
    if USERS:  # asyncio.wait doesn't accept an empty list
        message = users_event()
        await asyncio.wait([user.send(message) for user in USERS])


async def register(websocket):
    USERS.add(websocket)

    await notify_users()


async def unregister(websocket):
    USERS.remove(websocket)
    await notify_users()


async def counter(websocket, path):
    # register(websocket) sends user_event() to websocket
    await register(websocket)
    try:
        await websocket.send(state_event())
        async for message in websocket:
            data = json.loads(message)
            #Registo do medico
            print(message)
            if data["action"] == "senha":
                if data["esp"] == "ger":
                    STATE['total_geral'] += 1
                    STATE['last'] = "ger"

                elif data["esp"] == "oft":
                    STATE['total_oftalmologista'] += 1
                    STATE['last'] = "oft"

                elif data["esp"] == "car":
                    STATE['total_cardiologia'] += 1
                    STATE['last'] = "car"

                elif data["esp"] == "psi":
                    STATE['total_psicologia'] += 1
                    STATE['last'] = "psi"

                STATE["status"] = 'done'
                STATE["som"] = ''
                await notify_state()

            elif data["action"] == "proximo":

                if data["esp"] == "Geral":
                    if STATE['atual_geral'] < STATE['total_geral']:
                        STATE['atual_geral'] += 1
                        STATE["status"] = 'done'
                        STATE['last'] = ""
                        STATE["som"] = "sound.mp3"
                        info = {"nome" : data["medico"],"senha":STATE["atual_geral"],"especialidade":"geral"}
                        ordem.append(info)
                        STATE['ordem']=ordem[-5:]
                    else:
                        STATE["som"] = ""
                        STATE["status"] = 'error'
                    await notify_state()

                elif data["esp"] == "Oftalmologista":
                    if STATE['atual_oftalmologista'] < STATE['total_oftalmologista']:
                        STATE['atual_oftalmologista'] += 1
                        STATE["status"] = 'done'
                        STATE['last'] = ""
                        STATE["som"] = "sound.mp3"
                        info = {"nome" : data["medico"],"senha":STATE["atual_oftalmologista"],"especialidade":"Oftalmologista"}
                        ordem.append(info)
                        STATE['ordem']=ordem[-5:]
                    else:
                        STATE["som"] = ""
                        STATE["status"] = 'error'
                    await notify_state()

                elif data["esp"] == "Cardiologia":
                    if STATE['atual_cardiologia'] < STATE['total_cardiologia']:
                        STATE['atual_cardiologia'] += 1
                        STATE["status"] = 'done'
                        STATE['last'] = ""
                        STATE["som"] = "sound.mp3"
                        info = {"nome" : data["medico"],"senha":STATE["atual_cardiologia"],"especialidade":"Cardiologia"}
                        ordem.append(info)
                        STATE['ordem']=ordem[-5:]
                    else:
                        STATE["som"] = ""
                        STATE["status"] = 'error'
                    await notify_state()

                elif data["esp"] == "Psicologia":
                    if STATE['atual_psicologia'] < STATE['total_psicologia']:
                        STATE['atual_psicologia'] += 1
                        STATE['last'] = ""
                        STATE["status"] = 'done'
                        STATE["som"] = "sound.mp3"
                        info = {"nome" : data["medico"],"senha":STATE["atual_psicologia"],"especialidade":"Psicologia"}
                        ordem.append(info)
                        STATE['ordem']=ordem[-5:]
                    else:
                        STATE["som"] = ""
                        STATE["status"] = 'error'
                    await notify_state()


            else:
                logging.error("unsupported event: {}", data)
    finally:
        await unregister(websocket)



start_server = websockets.serve(counter, ip, 6788)

asyncio.get_event_loop().run_until_complete(start_server)
print('Servidor ON')
asyncio.get_event_loop().run_forever()
