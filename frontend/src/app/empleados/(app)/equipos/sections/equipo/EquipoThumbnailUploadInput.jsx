'use client'
import { useFormState } from 'react-dom'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { useToast } from '@/components/ui/use-toast'
import { updateEquipoThumbnail } from '../../equipos-actions'
import { EMPTY_FORM_STATE } from '@/lib/utils'
import { useEffect } from 'react'
import InputError from '@/components/InputError'
import SubmitButton from '@/components/SubmitButton'
import { Save } from 'lucide-react'

const ACCEPTED_IMAGE_TYPES = [
  'image/jpeg',
  'image/jpg',
  'image/png',
  'image/webp',
]

export default function EquipoThumbnailUploadInput({ equipo }) {
  const { toast } = useToast()
  const [formState, action] = useFormState(
    updateEquipoThumbnail,
    EMPTY_FORM_STATE,
  )

  useEffect(() => {
    if (formState.status === 'SUCCESS') {
      toast({
        title: `😄 ${formState.message}`,
      })
    } else if (
      formState.status === 'ERROR' &&
      Object.keys(formState.fieldErrors).length == 0
    ) {
      toast({
        title: `🥲 ${formState.message}`,
        description: 'Intente de nuevo más tarde.',
        variant: 'destructive',
      })
    }
  }, [formState])

  return (
    <div className="grid grid-cols-12 gap-2">
      {equipo?.thumb_url !== '' ? (
        <img
          className="col-span-6 rounded-md border-2 border-slate-400"
          src={equipo?.thumb_url}
        />
      ) : (
        <img
          className="col-span-4 rounded-md border-2 border-slate-400"
          src="/dummy.png"
        />
      )}
      <form action={action} className="col-span-6 flex flex-col gap-2">
        <Label htmlFor="thumb">Thumbnail</Label>
        <Input
          id="thumb"
          name="thumb"
          type="file"
          accept={ACCEPTED_IMAGE_TYPES.join(',')}
        />
        <InputError messages={formState?.fieldErrors?.thumbnail} />
        <input type="hidden" name="equipoId" value={equipo?.id ?? ''} />
        <SubmitButton
          label="Subir"
          loading="subiendo..."
          icon={<Save className="h-4 w-4" />}
        />
      </form>
    </div>
  )
}
