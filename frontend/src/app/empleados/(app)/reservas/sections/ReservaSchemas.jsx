import { convertToUTC } from '@/lib/utils'
import { z } from 'zod'

export const reservaSchema = z
  .object({
    comentario: z.string().nullable(),
    nombre: z.string().nullable(),
    apellido: z.string().min(1, 'Se requiere apellido'),
    email: z
      .string()
      .email('Escriba un email válido')
      .min(1, 'Se requiere email'),
    telefono: z.string().nullable(),
    fecha_desde: z
      .string({
        required_error: 'Se requiere fecha inicio',
      })
      .date('Se requiere fecha inicio')
      .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
        message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
      }),
    fecha_hasta: z
      .string({
        required_error: 'Se requiere fecha fin',
      })
      .date('Se requiere fecha fin'),
    fecha_prueba: z
      .string({
        required_error: 'Se requiere fecha prueba',
      })
      .date('Se requiere fecha prueba'),
  })
  .refine(
    data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
    {
      message: 'Fecha fin no puede ser menor a fecha inicio',
      path: ['fecha_hasta'],
    },
  )

export const reservaSchemaEdit = z.object(
  {
    comentario: z.string().nullable(),
    nombre: z.string().nullable(),
    apellido: z.string().min(1, 'Se requiere apellido'),
    email: z
      .string()
      .email('Escriba un email válido')
      .min(1, 'Se requiere email'),
    telefono: z.string().nullable(),
  },
  // fecha_desde: z
  //   .string({
  //     required_error: 'Se requiere fecha inicio',
  //   })
  //   .date('Se requiere fecha inicio'),
  // fecha_hasta: z
  //   .string({
  //     required_error: 'Se requiere fecha fin',
  //   })
  //   .date('Se requiere fecha fin'),
  // fecha_prueba: z
  //   .string({
  //     required_error: 'Se requiere fecha prueba',
  //   })
  //   .date('Se requiere fecha prueba'),
  // })
  // .refine(
  //   data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
  //   {
  //     message: 'Fecha fin no puede ser menor a fecha inicio',
  //     path: ['fecha_hasta'],
  //   },
  // )
  // .refine(
  //   data => convertToUTC(data.fecha_prueba) >= convertToUTC(data.fecha_desde),
  //   {
  //     message: 'Fecha prueba no puede ser menor a fecha inicio',
  //     path: ['fecha_prueba'],
  //   },
)
