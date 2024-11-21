import { convertToUTC } from '@/lib/utils'
import { z } from 'zod'

export const reservaSchema = z
  .object({
    comentario: z.string().nullable(),
    cliente_id: z.number().nullable(),
    nombre: z.string().nullable(),
    apellido: z.string().nullable(),
    email: z.string().email().nullable(),
    telefono: z.string().nullable(),
    crear_user: z.boolean().nullable(),
    fecha_desde: z
      .string({
        required_error: 'Se requiere fecha inicio',
      })
      .refine(data => !isNaN(Date.parse(data)), {
        message: 'Se requiere fecha inicio válida',
      })
      .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
        message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
      }),
    fecha_hasta: z
      .string({
        required_error: 'Se requiere fecha fin',
      })
      .refine(data => !isNaN(Date.parse(data)), {
        message: 'Se requiere fecha fin válida',
      }),
    fecha_prueba: z
      .string({
        required_error: 'Se requiere fecha prueba',
      })
      .refine(data => !isNaN(Date.parse(data)), {
        message: 'Se requiere fecha prueba válida',
      }),
  })
  .superRefine((data, ctx) => {
    // Conditional validation: if cliente_id is null, nombre, apellido, and email are required
    if (data.cliente_id === null) {
      if (!data.nombre) {
        ctx.addIssue({
          path: ['nombre'],
          message: 'Se requiere nombre cuando es cliente nuevo',
        })
      }
      if (!data.apellido) {
        ctx.addIssue({
          path: ['apellido'],
          message: 'Se requiere apellido cuando es cliente nuevo',
        })
      }
      if (!data.email) {
        ctx.addIssue({
          path: ['email'],
          message: 'Se requiere email cuando es cliente nuevo',
        })
      }
    }

    // If nombre, apellido, and email are null, cliente_id is required
    if (
      !data.nombre &&
      !data.apellido &&
      !data.email &&
      data.cliente_id === null
    ) {
      ctx.addIssue({
        path: ['cliente_id'],
        message:
          'Se requiere seleccionar cliente cuando no se proporcionan nombre, apellido, y email',
      })
    }

    // Ensure fecha_hasta is greater than or equal to fecha_desde
    if (
      data.fecha_desde &&
      data.fecha_hasta &&
      convertToUTC(data.fecha_hasta) < convertToUTC(data.fecha_desde)
      // new Date(data.fecha_hasta) < new Date(data.fecha_desde)
    ) {
      ctx.addIssue({
        path: ['fecha_hasta'],
        message: 'Fecha fin no puede ser menor a fecha inicio',
      })
    }
  })

export const reservaSchemaEdit = z.object({
  comentario: z.string().nullable(),
  nombre: z.string().nullable(),
  apellido: z.string().min(1, 'Se requiere apellido'),
  email: z
    .string()
    .email('Escriba un email válido')
    .min(1, 'Se requiere email'),
  telefono: z.string().nullable(),
})
