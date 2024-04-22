import axios from 'axios'
import { clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'
import { ZodError } from 'zod'

export function cn(...inputs) {
  return twMerge(clsx(inputs))
}

/**
 * status: UNSET | SUCCESS | ERROR
 */
export const EMPTY_FORM_STATE = {
  status: 'UNSET',
  message: '',
  fieldErrors: {},
  timestamp: Date.now(),
}

export const toFormState = (status, message) => {
  return {
    status,
    message,
    fieldErrors: {},
    timestamp: Date.now(),
  }
}

export const fromErrorToFormState = error => {
  // validación de Next
  if (error instanceof ZodError) {
    return {
      status: 'ERROR',
      message: '',
      fieldErrors: error.flatten().fieldErrors,
      timestamp: Date.now(),
    }
    // validación de Laravel
  } else if (axios.isAxiosError(error)) {
    return {
      status: 'ERROR',
      message: error.message,
      fieldErrors: error.response.data.errors,
      timestamp: Date.now(),
    }
    // Se chingó otra cosa
  } else {
    return {
      status: 'ERROR',
      message: 'Ha ocurrido un error inesperado.',
      fieldErrors: {},
      timestamp: Date.now(),
    }
  }
}
