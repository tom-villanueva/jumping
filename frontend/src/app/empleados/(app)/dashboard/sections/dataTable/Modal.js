import { Button } from '@/components/ui/button'
import {
  Dialog,
  DialogClose,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Eye } from 'lucide-react'

export function Modal({ payment }) {
  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button variant="outline" type="button">
          <Eye />
        </Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Detalle</DialogTitle>
          <DialogDescription>
            Aqui puedes ver los detalles del movimiento
          </DialogDescription>
        </DialogHeader>
        <div className="grid gap-4 py-4">
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">ID</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.id}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Estado</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.estado}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Metodo</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.metodo}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Valor</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.valor}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Nombre</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.nombre}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Fecha</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.fecha}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Hora</p>
            <p className="col-span-3 rounded-lg border border-white text-center text-slate-400">
              {payment.hora}
            </p>
          </div>
          <div className="grid grid-cols-4 items-center gap-4">
            <p className="text-right text-white">Banco</p>
            <p className="col-span-3 rounded-lg  border border-white text-center text-slate-400">
              {payment.banco}
            </p>
          </div>
        </div>
        <DialogFooter>
          <DialogClose asChild>
            <Button type="button" variant="secondary">
              Cerrar
            </Button>
          </DialogClose>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  )
}
