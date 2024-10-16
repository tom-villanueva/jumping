import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from '@/components/ui/card'

import React from 'react'

const InfoCard = ({ title, number, percentage, footer }) => {
  return (
    <Card className="w-full">
      <CardHeader>
        <CardTitle>{title}</CardTitle>
      </CardHeader>
      <CardContent>
        <p className="text-white">{number}</p>
        <p className={percentage > 5 ? 'text-green-600' : 'text-red-700'}>
          {Math.round(percentage)}%
        </p>
      </CardContent>
      <CardFooter>
        <p>{footer}</p>
      </CardFooter>
    </Card>
  )
}

export default InfoCard
