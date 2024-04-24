'use client'
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import EquipoForm from './EquipoForm'
import { Button } from '@/components/ui/button'
import { useState } from 'react'

export default function CreateEquipoForm({ tipoArticulos }) {
  const [open, setOpen] = useState(false)

  return (
    <Dialog open={open} onOpenChange={() => setOpen(!open)}>
      <DialogTrigger asChild>
        <Button variant="outline">Agregar Equipo</Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Agregar Equipo</DialogTitle>
          <DialogDescription>
            Rellenar todos los datos. Apretar guardar cuando termines.
          </DialogDescription>
        </DialogHeader>
        <EquipoForm
          tipoArticulos={tipoArticulos}
          closeDialog={() => setOpen(false)}
        />
      </DialogContent>
    </Dialog>
  )
}
