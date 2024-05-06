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

export function Modal({ payment }) {
  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button className="bg-transparent hover:bg-slate-700">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            className="h-4 w-4">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
            />
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
            />
          </svg>
        </Button>
      </DialogTrigger>
      <DialogContent className="bg-slate-900 sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle className="text-white">Detalle</DialogTitle>
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
