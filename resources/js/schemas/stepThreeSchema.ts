import { z } from "zod";

export const stepThreeSchema = z.object({
    estate_city: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    estate_region: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    estate_line_1: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
    estate_line_2: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
});

export type StepThreeSchema = z.infer<typeof stepThreeSchema>;
