import { z } from "zod";

export const trainingApplicationFormSchema = z.object({
    trainingType: z.string().min(1, "نوع التدريب مطلوب"),
    cv_file: z
        .any()
        .refine((file) => file instanceof File || file instanceof Blob, {
            message: "السيرة الذاتية مطلوبة",
        }),
    university_name: z.string().min(1, "اسم الجامعة مطلوب"),
    training_period: z.string().min(1, "مدة التدريب مطلوبة"),
    starting_date: z.string().min(1, "تاريخ البدء مطلوب"),
    phone_number: z
        .string()
        .min(10, "رقم الجوال يجب أن يكون 10 أرقام على الأقل")
        .regex(/^[0-9+]+$/, "رقم الجوال يجب أن يحتوي على أرقام فقط"),
});

export type trainingApplicationFormSchema = z.infer<
    typeof trainingApplicationFormSchema
>;
