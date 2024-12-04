'use client'
import React from 'react'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { DataTable } from '@/components/client-table/data-table'
import { getCoreRowModel, useReactTable } from '@tanstack/react-table'
import { useEffect, useState } from 'react'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import { Checkbox } from '@/components/ui/checkbox'

export default function RegisterForm({}) {
  // const [data, setData] = useState([])

  const data = [
    {
      nombreArticulo: 'Articulo 1',
      precio: '$100',
      nombre: 'Pepe',
      apellido: 'Gomez',
    },
  ]
  const [openUpdateModal, setOpenUpdateModal] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedPrecio, setSelectedPrecio] = useState({})

  const columns = [
    {
      header: 'Articulo',
      accessorKey: 'nombreArticulo',
    },
    {
      header: 'Precio x Día',
      accessorKey: 'precio',
    },
    {
      header: 'Nombre (Opcional)',
      accessorKey: 'nombre',
    },
    {
      header: 'Apellido (Opcional)',
      accessorKey: 'apellido',
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const selected = row.original

        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedPrecio(selected)
                setOpenUpdateModal(!openUpdateModal)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedPrecio(selected)
                setOpenDeleteForm(!openDeleteForm)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  const table = useReactTable({
    data,
    columns,
    getCoreRowModel: getCoreRowModel(),
  })
  return (
    <div className="flex w-full flex-col">
      <div className="flex w-full flex-col justify-center gap-5">
        <div className="flex w-full flex-col items-center justify-center">
          <p className="my-10 text-center font-montserrat font-medium uppercase">
            Datos del Responsable
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
                Emails
              </Label>
              <Input
                type="email"
                placeholder="Email"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4">
              <Label
                className="font-montserrat font-bold tracking-widest"
                htmlFor="">
                Repetir Email
              </Label>
              <Input
                type="email"
                placeholder="Email"
                className="bg-transparent"
              />
            </div>
            <div className="col-span-4">
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
          </div>
          <p className="mt-5 text-center font-montserrat font-thin">
            Ya tienes cuenta? <a className="font-bold">Logeate</a>
          </p>
        </div>

        <hr className="mt-3"></hr>

        <p className="mb-5 mt-5 text-center font-montserrat font-medium uppercase">
          RESUMEN DE ARTICULOS
        </p>
        <div className="flex w-full flex-col items-center justify-center">
          <div className="flex w-full overflow-auto">
            <DataTable
              table={table}
              columns={columns}
              //isLoading={isLoading}
              filters={[]}
            />
          </div>

          <div className="mt-10 flex w-full flex-col items-center justify-center">
            <p className="font-montserrat text-lg font-bold uppercase">
              Precio Total:
            </p>
            <span className="rounded-lg bg-white px-5 font-montserrat text-lg font-bold text-red-600">
              $10000
            </span>
          </div>
        </div>

        {/* <div className="flex w-full flex-col items-center justify-center sm:ml-10 sm:w-1/2">
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
        </div> */}

        {/* <div className="flex max-h-[600px] w-full flex-col">
          
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
        </div> */}
      </div>

      <div className="mt-10 flex items-center justify-center">
        <div className="items-top flex space-x-2">
          <Checkbox id="terms1" />
          <div className="grid gap-1.5 leading-none">
            <label
              htmlFor="terms1"
              className="font-montserrat text-sm font-bold leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
              Aceptar Terminos y condiciones
            </label>
            <p className="text-sm text-muted-foreground">
              You agree to our Terms of Service and Privacy Policy.
            </p>
          </div>
        </div>
      </div>

      <div className="mt-10 flex flex-col items-center justify-center gap-10 sm:flex-row">
        <button className="rounded-full bg-red-600 px-5 py-3 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800">
          Reservar
        </button>
      </div>
    </div>
  )
}
