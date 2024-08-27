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
import { useSWRConfig } from 'swr'
import { Button } from '@/components/ui/button'
import { deleteFetcher } from '@/lib/utils'

export default function DeleteEntityForm({
  openDeleteForm,
  setOpenDeleteForm,
  entity,
  apiKey,
  mutateKey,
  name,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const { trigger, isMutating } = useSWRMutation(apiKey, deleteFetcher, {
    onSuccess() {
      toast({
        title: `😄 ${name} eliminado con éxito`,
      })

      mutate(key => Array.isArray(key) && key[0] === (mutateKey ?? apiKey))
    },
    onError(err) {
      toast({
        title: `🥲 Ocurrió un error`,
        description: 'Intente de nuevo más tarde.',
        variant: 'destructive',
      })
    },
  })

  function handleOnSubmit(e) {
    e.preventDefault()

    trigger({ id: entity?.id })
    setOpenDeleteForm(false)
  }

  return (
    <Dialog
      open={openDeleteForm}
      onOpenChange={() => setOpenDeleteForm(!openDeleteForm)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Eliminar {name}</DialogTitle>
          <DialogDescription>
            Se eliminará permanentemente el {name}.
          </DialogDescription>
        </DialogHeader>
        <form onSubmit={handleOnSubmit}>
          <Button variant="destructive" className="w-full" type="submit">
            {isMutating ? 'Eliminando...' : 'Confirmar'}
          </Button>
        </form>
      </DialogContent>
    </Dialog>
  )
}
