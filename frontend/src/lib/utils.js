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

export class CustomValidationError extends Error {
  constructor(message, errors) {
    super(message)
    this.name = 'CustomValidationError'
    this.errors = errors
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
    // validación de Laravel desde axios
  } else if (axios.isAxiosError(error)) {
    return {
      status: 'ERROR',
      message: error?.response?.data?.message ?? error?.message,
      fieldErrors: error?.response?.data?.errors ?? {},
      timestamp: Date.now(),
    }
    // validación de Laravel pero desde fetch
  } else if (error instanceof CustomValidationError) {
    return {
      status: 'ERROR',
      message: error.message,
      fieldErrors: error.errors,
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

export const formatDate = date => {
  const year = date.getFullYear()
  const month = String(date.getMonth() + 1).padStart(2, '0')
  const day = String(date.getDate()).padStart(2, '0')
  return `${year}-${month}-${day}`
}

export const convertToUTC = date => {
  const localDate = new Date(date)
  const offset = localDate.getTimezoneOffset()
  const utcTimestamp = localDate.getTime() + offset * 60 * 1000
  return new Date(utcTimestamp)
}
