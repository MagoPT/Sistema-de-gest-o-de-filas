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
matriz = [especialidade,medico, n_senha, senha_atual]
'''

total = ['', '', '', '']

total[0]='geral','magopt',0,0

STATE = {"total": total[0][2], "atual":total[0][3],"medico":total[0][1]}

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
            print(data)
            if data["action"] == "senha":
                STATE["total"] += 1
                await notify_state()
            elif data["action"] == "proximo":
                if STATE["atual"] < STATE["total"]:
                    STATE["atual"] += 1
                await notify_state()
            else:
                logging.error("unsupported event: {}", data)
    finally:
        await unregister(websocket)


start_server = websockets.serve(counter, "127.0.0.1", 6789)

asyncio.get_event_loop().run_until_complete(start_server)
print('Servidor ON')
asyncio.get_event_loop().run_forever()
