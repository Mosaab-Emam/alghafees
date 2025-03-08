import { z } from "zod";

export const stepThreeSchema = z.object({
    location: z
        .string()
        .min(1, { message: "مطلوب" })
        .max(255, { message: "255 حرف كحد أقصى" }),
});

export type StepThreeSchema = z.infer<typeof stepThreeSchema>;
