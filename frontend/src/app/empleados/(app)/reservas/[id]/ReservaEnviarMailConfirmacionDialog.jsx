'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import axios from 'axios'
import { updateFetcher } from '@/lib/utils'
import { Button } from '@/components/ui/button'

export default function ReservaEnviarMailConfirmacionDialog({
  openForm,
  setOpenForm,
  reservaId,
  reserva,
}) {
  const { toast } = useToast()

  const { trigger, isMutating } = useSWRMutation(
    '/api/reservas/enviar-confirmacion',
    updateFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 mail enviado con éxito`,
        })
      },
      onError(err) {
        if (axios.isAxiosError(err)) {
          if (err.response.status === 422) {
            const errors = err.response.data.errors ?? {}
            for (const [key, value] of Object.entries(errors)) {
              toast({
                title: `🥲 Ocurrió un error ${value.join(', ')}`,
                description: 'Revise.',
                variant: 'destructive',
              })
            }
          } else {
            toast({
              title: `🥲 Ocurrió un error ${err.response.data.message}`,
              description: 'Intente de nuevo más tarde.',
              variant: 'destructive',
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
  function handleOnSubmit(e) {
    e.preventDefault()

    trigger({ id: reservaId })
    setOpenForm(false)
  }

  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[600px]">
        <DialogHeader>
          <DialogTitle>
            Reenviar confirmación a la reserva Nro. {reservaId}
          </DialogTitle>
          <DialogDescription>
            Se enviará mail al correo asignado a la reserva.
          </DialogDescription>
        </DialogHeader>
        <form onSubmit={handleOnSubmit}>
          <Button variant="destructive" className="w-full" type="submit">
            {isMutating ? 'Enviando...' : 'Enviar'}
          </Button>
        </form>
      </DialogContent>
    </Dialog>
  )
}
