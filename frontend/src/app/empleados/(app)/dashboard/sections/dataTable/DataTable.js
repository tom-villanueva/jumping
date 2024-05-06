'use client'
import React from 'react'
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import Button from '@/components/Button'
import { Modal } from '@/app/empleados/(app)/dashboard/sections/dataTable/Modal'

const data = [
  {
    id: 1,
    estado: 'pendiente',
    metodo: 'tarjeta',
    valor: 50.0,
    nombre: 'Juan Perez',
    fecha: '2023-05-01',
    hora: '10:00 AM',
    banco: 'MercadoPago',
  },
  {
    id: 2,
    estado: 'pagado',
    metodo: 'transferencia',
    valor: 100.0,
    nombre: 'Maria Gomez',
    fecha: '2023-05-02',
    hora: '11:00 AM',
    banco: 'Banco Santander',
  },
  {
    id: 3,
    estado: 'pendiente',
    metodo: 'efectivo',
    valor: 75.0,
    nombre: 'Pedro Rodriguez',
    fecha: '2023-05-03',
    hora: '12:00 PM',
    banco: 'MercadoPago',
  },
  {
    id: 4,
    estado: 'pagado',
    metodo: 'cheque',
    valor: 120.0,
    nombre: 'Ana Lopez',
    fecha: '2023-05-04',
    hora: '1:00 PM',
    banco: 'MercadoPago',
  },
  {
    id: 5,
    estado: 'pendiente',
    metodo: 'tarjeta',
    valor: 90.0,
    nombre: 'Luis Sanchez',
    fecha: '2023-05-05',
    hora: '2:00 PM',
    banco: 'MercadoPago',
  },
  {
    id: 6,
    estado: 'pendiente',
    metodo: 'transferencia',
    valor: 60.0,
    nombre: 'Marta Ramirez',
    fecha: '2023-05-06',
    hora: '3:00 PM',
    banco: 'Banco Nacion',
  },
  {
    id: 7,
    estado: 'pagado',
    metodo: 'efectivo',
    valor: 80.0,
    nombre: 'Jorge Gomez',
    fecha: '2023-05-07',
    hora: '4:00 PM',
    banco: 'Banco Frances',
  },
  {
    id: 8,
    estado: 'error',
    metodo: 'cheque',
    valor: 200.0,
    nombre: 'Sara Martinez',
    fecha: '2023-05-08',
    hora: '5:00 PM',
    banco: 'Banco Macro',
  },
  {
    id: 9,
    estado: 'pendiente',
    metodo: 'tarjeta',
    valor: 150.0,
    nombre: 'Jorge Martinez',
    fecha: '2023-05-09',
    hora: '6:00 PM',
    banco: 'Banco Frances',
  },
  {
    id: 10,
    estado: 'pagado',
    metodo: 'transferencia',
    valor: 175.0,
    nombre: 'Sara Rodriguez',
    fecha: '2023-05-10',
    hora: '7:00 PM',
    banco: 'Banco Nacion',
  },
]

export const DataTable = () => {
  return (
    <div>
      <Table>
        <TableCaption>Ultimos 10 pagos entrantes.</TableCaption>
        <TableHeader>
          <TableRow>
            <TableHead className="w-[100px] text-white">ID</TableHead>
            <TableHead className="text-white">Estado</TableHead>
            <TableHead className="text-white">Metodo</TableHead>
            <TableHead className="text-white">Valor</TableHead>
            <TableHead className="text-right text-white">Detalles</TableHead>
          </TableRow>
        </TableHeader>
        <TableBody>
          {data.map(payment => (
            <TableRow>
              <TableCell className="font-medium text-white">
                {payment.id}
              </TableCell>
              <TableCell
                className={
                  payment.estado === 'pagado'
                    ? 'font-bold uppercase text-green-400'
                    : payment.estado === 'pendiente'
                      ? 'uppercase text-yellow-400'
                      : 'font-bold uppercase text-red-400'
                }>
                {payment.estado}
              </TableCell>
              <TableCell className="font-medium  text-white">
                {payment.metodo}
              </TableCell>
              <TableCell className="font-medium  text-white">
                ${payment.valor}
              </TableCell>
              <TableCell className="text-right">
                <Modal payment={payment}></Modal>
              </TableCell>
            </TableRow>
          ))}
        </TableBody>
      </Table>
    </div>
  )
}
