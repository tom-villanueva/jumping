import { Skeleton } from '@/components/ui/skeleton'

export default function ReservaDetailLabel({ title, label, isValidating }) {
  return (
    <>
      {!isValidating ? (
        <p>
          {`${title} `}
          <span className="font-bold">{label}</span>
        </p>
      ) : (
        <Skeleton className="mt-2 h-4 w-[200px]" />
      )}
    </>
  )
}
