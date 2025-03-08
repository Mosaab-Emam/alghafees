import { z } from "zod";

export const stepTwoSchema = z.object({
    type_id: z.string().min(1, { message: "مطلوب" }),
    real_estate_details: z.string().optional(),
    entity_id: z.string().optional(),
    real_estate_age: z
        .string()
        .min(1, { message: "مطلوب" })
        .refine((val) => !isNaN(Number(val)) && Number(val) >= 1, {
            message: "يجب أن يكون عدد أكبر من أو يساوي 1",
        }),
    real_estate_area: z
        .string()
        .min(1, { message: "مطلوب" })
        .refine((val) => !isNaN(Number(val)) && Number(val) >= 1, {
            message: "يجب أن يكون عدد أكبر من أو يساوي 1",
        }),
    usage_id: z.string(),
});

export type StepTwoSchema = z.infer<typeof stepTwoSchema>;
