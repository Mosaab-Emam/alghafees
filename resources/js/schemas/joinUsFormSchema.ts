import { z } from "zod";

export const joinUsFormSchema = z.object({
    firstName: z.string().min(1, "الاسم الأول مطلوب"),
    lastName: z.string().min(1, "الاسم الأخير مطلوب"),
    email: z.string().email("البريد الإلكتروني غير صالح"),
    phone: z
        .string()
        .min(10, "رقم الجوال يجب أن يكون 10 أرقام على الأقل")
        .regex(/^[0-9+]+$/, "رقم الجوال يجب أن يحتوي على أرقام فقط"),
    role: z.string().min(1, "نوع الوظيفة مطلوب"),
    personalDescription: z.string().min(1, "النبذة الشخصية مطلوبة"),
});

export type JoinUsFormSchema = z.infer<typeof joinUsFormSchema>;
