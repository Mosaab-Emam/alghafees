import { z } from "zod";

export const stepOneSchema = z.object({
    first_name: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    last_name: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    mobile: z
        .string()
        .min(1, { message: "مطلوب" })
        .regex(/^05[0-9]{8}$/, {
            message: "رقم الهاتف غير صحيح يجب أن يكون 10 أرقام بدءاً بـ 05",
        }),
    email: z
        .string()
        .min(1, { message: "مطلوب" })
        .email({ message: "صيغة البريد الإلكتروني غير صحيحة" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    address: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    address_city: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    address_neighbourhood: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    goal_id: z.string().min(1, { message: "مطلوب" }),
    notes: z.string().min(1, { message: "مطلوب" }),
});

export type StepOneSchema = z.infer<typeof stepOneSchema>;
