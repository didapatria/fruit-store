import type { User } from '@/types/User';

export type Product = {
    id: number;
    user_id: number;
    user: User;
    name: string;
    description: string;
    price: number;
    stock: number;
};
