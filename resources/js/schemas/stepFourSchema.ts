import { z } from "zod";

export const stepFourSchema = z.object({
    instrument_image: z.instanceof(File).nullable(),
    construction_license: z.instanceof(File).nullable(),
    other_contracts: z.instanceof(File).nullable(),
});

export type StepFourSchema = z.infer<typeof stepFourSchema>;
