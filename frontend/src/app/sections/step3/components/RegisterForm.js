import React from 'react'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'

export default function RegisterForm() {
  return (
    <div>
      <div className="flex w-full flex-col items-start justify-center gap-5 sm:flex-row">
        <div className="flex w-full flex-col items-center justify-center sm:ml-10 sm:w-1/2">
          <p className="my-10 text-center font-montserrat font-medium uppercase">
            Registro del Responsable
          </p>

          <div className="grid w-full grid-cols-4 gap-5">
            <div className="col-span-4 sm:col-span-2">
              <Label className="font-montserrat font-bold" htmlFor="">
                Nombre
              </Label>
              <Input
                type="text"
                placeholder="Nombre"
                className=" bg-transparent"
              />
            </div>
            <div className="col-span-4 sm:col-span-2 ">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                Apellido
              </Label>
              <Input
                type="text"
                placeholder="Apellido"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                Email
              </Label>
              <Input
                type="email"
                placeholder="Email"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4 sm:col-span-2">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                Telefono
              </Label>
              <Input
                type="number"
                placeholder="Telefono"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4 sm:col-span-2">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                DNI
              </Label>
              <Input
                type="number"
                placeholder="DNI"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4 sm:col-span-2">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                Contraseña
              </Label>
              <Input
                type="text"
                placeholder="Contraseña"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4 sm:col-span-2">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                Confirmar Contraseña
              </Label>
              <Input
                type="text"
                placeholder="Confirmar Contraseña"
                className="bg-transparent"
              />
            </div>
          </div>
          <p className="mt-5 text-center font-montserrat font-thin">
            Ya tienes cuenta? <span className="font-bold">Logeate</span>
          </p>
        </div>

        <div className="mr-10 flex max-h-[600px] w-full flex-col sm:w-1/2">
          <p className="my-10 text-center font-montserrat font-medium uppercase">
            RESUMEN
          </p>
          <div className=" rounded-lg border-[1px]">
            <ul className="max-h-[400px] overflow-y-scroll">
              <li className="grid gap-y-5 border-b-[1px] px-10 py-5 font-montserrat sm:grid-cols-3">
                <p className="font-medium">
                  Item:<span className="font-thin"> Equipo completo x1/</span>
                </p>
                <p className="font-medium">
                  Nivel:<span className="font-thin"> Principiante/</span>
                </p>
                <p className="font-bold text-red-600 sm:text-end">$15000</p>
                <p className="font-medium">
                  Altura:<span className="font-thin"> 172cm/</span>
                </p>
                <p className="font-medium">
                  Talle:<span className="font-thin"> L</span>
                </p>
              </li>
              <li className="grid gap-y-5 border-b-[1px] px-10 py-5 font-montserrat sm:grid-cols-3">
                <p className="font-medium">
                  Item:<span className="font-thin"> Equipo completo x1/</span>
                </p>
                <p className="font-medium">
                  Nivel:<span className="font-thin"> Principiante/</span>
                </p>
                <p className="font-bold text-red-600 sm:text-end">$15000</p>
                <p className="font-medium">
                  Altura:<span className="font-thin"> 172cm/</span>
                </p>
                <p className="font-medium">
                  Talle:<span className="font-thin"> L</span>
                </p>
              </li>
              <li className="grid gap-y-5 border-b-[1px] px-10 py-5 font-montserrat sm:grid-cols-3">
                <p className="font-medium">
                  Item:<span className="font-thin"> Equipo completo x1/</span>
                </p>
                <p className="font-medium">
                  Nivel:<span className="font-thin"> Principiante/</span>
                </p>
                <p className="font-bold text-red-600 sm:text-end">$15000</p>
                <p className="font-medium">
                  Altura:<span className="font-thin"> 172cm/</span>
                </p>
                <p className="font-medium">
                  Talle:<span className="font-thin"> L</span>
                </p>
              </li>
              <li className="grid gap-y-5 border-b-[1px] px-10 py-5 font-montserrat sm:grid-cols-3">
                <p className="font-medium">
                  Item:<span className="font-thin"> Equipo completo x1/</span>
                </p>
                <p className="font-medium">
                  Nivel:<span className="font-thin"> Principiante/</span>
                </p>
                <p className="font-bold text-red-600 sm:text-end">$15000</p>
                <p className="font-medium">
                  Altura:<span className="font-thin"> 172cm/</span>
                </p>
                <p className="font-medium">
                  Talle:<span className="font-thin"> L</span>
                </p>
              </li>
            </ul>
            <div className="mx-10 my-5 flex flex-row justify-between">
              <p className="font-montserrat text-xl font-bold tracking-widest">
                TOTAL
              </p>
              <p className="font-montserrat text-xl font-bold tracking-widest text-red-600">
                $15.000
              </p>
            </div>
          </div>
        </div>
      </div>
      <a>
        <p className="mt-10 text-center text-sm font-light">
          Al continuar aceptas nuestros
          <span className="ml-1 cursor-pointer rounded-lg text-center font-bold text-red-600 hover:text-red-500">
            Terminos y Condiciones
          </span>
        </p>
      </a>
      <div className="mt-10 flex flex-col items-center justify-center gap-10 sm:flex-row">
        <button className="rounded-full bg-red-600 px-5 py-3 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800">
          PAGAR CON TARJETA
        </button>
        <button className="rounded-full bg-red-600 px-5 py-3 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800">
          TRANSFERENCIA/DEPOSITO
        </button>
      </div>
    </div>
  )
}
