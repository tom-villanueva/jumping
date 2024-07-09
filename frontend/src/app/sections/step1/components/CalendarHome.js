'use client'
import * as React from 'react'

import { Calendar } from '@/components/ui/calendar'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { Label } from '@/components/ui/label'
import { RadioGroup, RadioGroupItem } from '@/components/ui/radio-group'

export default function CalendarHome() {
  const [range, setRange] = React.useState(new Date())
  const [dateMode, setDateMode] = useState(1)

  function change({ datemode }) {
    if (datemode === 'range') {
      setDateMode(1)
      console.log(dateMode)
    } else if (datemode === 'multiple') {
      setDateMode(2)
      console.log(dateMode)
    }
  }

  return (
    <div className="mt-16">
      <div className="flex flex-col items-center gap-5">
        <RadioGroup defaultValue="option-one">
          <div className="flex items-center space-x-2">
            <RadioGroupItem
              value="option-one"
              id="option-one"
              onClick={() => change('range')}
            />
            <Label htmlFor="option-one">Seleccionar Rango</Label>
          </div>
          <div className="flex items-center space-x-2">
            <RadioGroupItem
              value="option-two"
              id="option-two"
              onClick={() => change('multiple')}
            />
            <Label htmlFor="option-two">Seleccion por separado</Label>
          </div>
        </RadioGroup>
      </div>
      <form className="flex flex-col items-center justify-center gap-14">
        <Calendar
          mode={dateMode === 1 ? 'range' : 'multiple'}
          min={3}
          selected={range}
          onSelect={setRange}
          className="rounded-md border"
        />
        <Button variant="primary" className="rounded-full bg-red-700">
          VER EQUIPOS
        </Button>
      </form>
    </div>
  )
}
