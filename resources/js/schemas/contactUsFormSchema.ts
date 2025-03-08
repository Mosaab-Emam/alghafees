import { z } from "zod";

export const contactUsFormSchema = z.object({
    name: z.string().min(2, "الاسم يجب أن يحتوي على حرفين على الأقل"),
    email: z.string().email("البريد الإلكتروني غير صالح"),
    phone: z
        .string()
        .regex(/^[0-9+]{10,}$/, "رقم الجوال غير صالح")
        .length(10, "رقم الجوال يجب أن يحتوي على 10 أرقام"),
    inquiry: z.string().min(10, "الاستفسار يجب أن يحتوي على 10 أحرف على الأقل"),
});
