import React from 'react'
import CalendarHome from './step1/components/CalendarHome'
import EquipmentSelection from './step2/components/EquipmentSelection'
import RegisterForm from './step3/components/RegisterForm'
import { useState } from 'react'
import { FormContextProvider } from './context/FormContext'

export default function RentForm({ setBgStyle }) {
  const [steps, setSteps] = useState(1)

  return (
    <div className="my-8 overflow-auto">
      <FormContextProvider>
        <form>
          {steps === 1 ? (
            <CalendarHome setSteps={setSteps} setBgStyle={setBgStyle} />
          ) : steps === 2 ? (
            <EquipmentSelection setSteps={setSteps} setBgStyle={setBgStyle} />
          ) : (
            <RegisterForm />
          )}
        </form>
      </FormContextProvider>
    </div>
  )
}
