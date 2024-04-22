import { z } from 'zod'
import { zodResolver } from '@hookform/resolvers/zod'
import { useForm } from 'react-hook-form'
import { Button } from '@/components/ui/button'
import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Plus } from 'lucide-react'

const schema = z.object({
  tipo_articulo_id: z
    .string({
      required_error: 'Debe elegir un tipo de artículo',
    })
    .min(1, 'Debe elegir un tipo de artículo'),
})

export default function EquipoTipoArticuloForm({ tipoArticulos }) {
  const form = useForm({
    resolver: zodResolver(schema),
    defaultValues: {
      tipo_articulo_id: '',
    },
  })

  function onSubmit(data) {
    console.log(data)
  }

  return (
    <Form {...form}>
      <div className="grid grid-cols-6 items-center gap-4 pt-4">
        <FormField
          control={form.control}
          name="tipo_articulo_id"
          render={({ field }) => (
            <FormItem className="col-span-5">
              <Select onValueChange={field.onChange} defaultValue={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione un tipo de artículo" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {tipoArticulos?.map(tipo => (
                    <SelectItem key={tipo.id} value={String(tipo.id)}>
                      {tipo.descripcion}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
              <FormMessage />
            </FormItem>
          )}
        />
        <Button
          className="col-span-1"
          variant="outline"
          type="click"
          onClick={form.handleSubmit(onSubmit)}>
          <Plus className="h-6 w-6" />
        </Button>
      </div>
    </Form>
  )
}
