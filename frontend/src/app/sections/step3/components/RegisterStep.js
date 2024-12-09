'use client'

import React, { useContext, useState } from 'react'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { DataTable } from '@/components/client-table/data-table'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import { Checkbox } from '@/components/ui/checkbox'
import { z } from 'zod'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import FormContext from '../../context/FormContext.jsx'
import useSWRMutation from 'swr/mutation'
import { storeFetcher } from '@/lib/utils'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'

const schema = z
  .object({
    nombre: z.string().min(1, 'Nombre es requerido'),
    apellido: z.string().min(1, 'Apellido es requerido'),
    email: z.string().email('Formato de email inválido'),
    email_confirmation: z.string().email('Formato de email inválido'),
    telefono: z.string().min(7, 'Mínimo de 7 dígitos'),
  })
  .refine(data => data.email === data.email_confirmation, {
    message: 'Los correos no coinciden',
    paths: ['email_confirmation'],
  })

const data = [
  {
    nombreArticulo: 'Articulo 1',
    precio: '$100',
    nombre: 'Pepe',
    apellido: 'Gomez',
  },
]

export default function RegisterStep({ onBack }) {
  const [openUpdateModal, setOpenUpdateModal] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedRow, setSelectedRow] = useState(null)

  const {
    selectedEquipos,
    selectedTraslados,
    createEquipoHandlers,
    createTrasladoHandlers,
  } = useContext(FormContext)

  const form = useForm({
    resolver: zodResolver(schema),
    defaultValues: {
      nombre: '',
      apellido: '',
      email: '',
      email_confirmation: '',
      telefono: '',
    },
  })

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
      cell: ({ row }) => (
        <div className="flex flex-row gap-2">
          <Button
            variant="outline"
            type="button"
            onClick={() => {
              setSelectedRow(row.original)
              setOpenUpdateModal(true)
            }}>
            <Edit className="h-4 w-4" />
          </Button>
          <Button
            variant="destructive"
            type="button"
            onClick={() => {
              setSelectedRow(row.original)
              setOpenDeleteForm(true)
            }}>
            <Trash className="h-4 w-4" />
          </Button>
        </div>
      ),
    },
  ]

  const { trigger, isMutating } = useSWRMutation(
    '/api/clientes/reserva',
    storeFetcher,
    {
      onSuccess(data) {
        console.log(data)

        toast({
          title: `😄 Reserva creada con éxito`,
        })

        // form.reset()
      },
      onError(err) {
        if (axios.isAxiosError(err)) {
          if (err.response.status === 422) {
            const errors = err.response.data.errors ?? {}
            for (const [key, value] of Object.entries(errors)) {
              form.setError(key, {
                type: 'manual',
                message: value.join(', '),
              })
            }
          } else {
            form.setError('root.serverError', {
              type: 'server',
              message: err.response.data.message,
            })
          }
        } else {
          toast({
            title: `🥲 Ocurrió un error ${err.message}`,
            description: 'Intente de nuevo más tarde.',
            variant: 'destructive',
          })
        }
      },
      throwOnError: false,
    },
  )

  const onSubmit = values => {
    const data = {
      ...values,
    }

    trigger({ data })
  }

  const table = useReactTable({
    data,
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <div className="flex w-full flex-col">
      <div className="flex w-full flex-col justify-center gap-5">
        <div className="flex w-full flex-col items-center justify-center">
          <p className="my-10 text-center font-montserrat font-medium uppercase">
            Datos del Responsable
          </p>
          <Form {...form}>
            <form
              onSubmit={form.handleSubmit(onSubmit)}
              className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
              <FormField
                control={form.control}
                name="nombre"
                render={({ field }) => (
                  <FormItem className="col-span-12">
                    <FormLabel>Nombre</FormLabel>
                    <FormControl>
                      <Input
                        id="nombre"
                        name="nombre"
                        placeholder="Escriba nombre"
                        className="col-span-12"
                        {...field}
                      />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="apellido"
                render={({ field }) => (
                  <FormItem className="col-span-12">
                    <FormLabel>Apellido</FormLabel>
                    <FormControl>
                      <Input
                        id="apellido"
                        name="apellido"
                        placeholder="Escriba apellido"
                        className="col-span-12"
                        {...field}
                      />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="email"
                render={({ field }) => (
                  <FormItem className="col-span-12">
                    <FormLabel>Email</FormLabel>
                    <FormControl>
                      <Input
                        id="email"
                        name="email"
                        placeholder="Escriba email"
                        className="col-span-12"
                        {...field}
                      />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="email_confirmation"
                render={({ field }) => (
                  <FormItem className="col-span-12">
                    <FormLabel>Repetir email</FormLabel>
                    <FormControl>
                      <Input
                        id="email_confirmation"
                        name="email_confirmation"
                        placeholder="Repetir email"
                        className="col-span-12"
                        {...field}
                      />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />
              <FormField
                control={form.control}
                name="telefono"
                render={({ field }) => (
                  <FormItem className="col-span-12">
                    <FormLabel>Telefono</FormLabel>
                    <FormControl>
                      <Input
                        id="telefono"
                        name="telefono"
                        placeholder="Escriba telefono"
                        className="col-span-12"
                        {...field}
                      />
                    </FormControl>
                    <FormMessage />
                  </FormItem>
                )}
              />

              <div className="col-span-12 flex flex-col">
                <hr className="mt-3"></hr>

                <p className="mt-5 text-center font-montserrat font-thin">
                  Ya tienes cuenta? <a className="font-bold">Logeate</a>
                </p>
                <p className="mb-5 mt-5 text-center font-montserrat font-medium uppercase">
                  RESUMEN DE ARTICULOS
                </p>
                <div className="flex w-full flex-col items-center justify-center">
                  <div className="flex w-full overflow-auto">
                    <DataTable
                      table={table}
                      columns={columns}
                      isLoading={false}
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
                  <Button className="rounded-full bg-red-600 px-5 py-3 font-montserrat font-bold transition-all duration-75 ease-in hover:bg-red-800">
                    Reservar
                  </Button>
                </div>
              </div>
            </form>
          </Form>
        </div>
      </div>
    </div>
  )
}
