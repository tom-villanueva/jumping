import { z } from 'zod'
import { zodResolver } from '@hookform/resolvers/zod'
import { useForm } from 'react-hook-form'
import { Button } from '@/components/ui/button'
import {
  Form,
  FormControl,
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
import { useContext } from 'react'
import SelectManyEntitiesContext from '../SelectManyEntitiesContext'

const schema = z.object({
  talle_id: z
    .string({
      required_error: 'Debe elegir un talle',
    })
    .min(1, 'Debe elegir un talle'),
  // stock: z
  //   .number({
  //     required_error: 'Se requiere stock',
  //     invalid_type_error: 'Tiene que ser un número',
  //   })
  //   .nonnegative('No puede ser negativo'),
})

function toDesiredShape(entity, stock) {
  return {
    id: entity.id,
    descripcion: entity.descripcion,
    stock,
  }
}

export default function TipoArticuloTalleForm() {
  const { addEntity, filteredEntities } = useContext(SelectManyEntitiesContext)

  const form = useForm({
    resolver: zodResolver(schema),
    defaultValues: {
      talle_id: '',
      // stock: 0,
    },
  })

  function onSubmit(data) {
    addEntity(Number(data.talle_id), entity => toDesiredShape(entity, 0))
    form.reset()
  }

  return (
    <Form {...form}>
      <div className="grid grid-cols-12 items-end gap-4 pb-4">
        <FormField
          control={form.control}
          name="talle_id"
          render={({ field }) => (
            <FormItem className="col-span-6">
              <FormLabel>Talle</FormLabel>
              <Select onValueChange={field.onChange} value={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione un talle" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {filteredEntities?.map(tipo => (
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
        {/* <FormField
          control={form.control}
          name="stock"
          render={({ field }) => (
            <FormItem className="col-span-4">
              <FormLabel>Stock</FormLabel>
              <FormControl>
                <Input
                  type="number"
                  placeholder="stock..."
                  {...field}
                  onChange={event => field.onChange(+event.target.value)}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        /> */}
        <Button
          className="col-span-2"
          variant="outline"
          type="button"
          onClick={form.handleSubmit(onSubmit)}>
          <Plus className="h-6 w-6" />
        </Button>
      </div>
    </Form>
  )
}
