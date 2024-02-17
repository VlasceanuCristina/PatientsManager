package com.example.licenta;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

public class ListAdapterParametri extends RecyclerView.Adapter {
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType){
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_parametri,parent,false);

        return new ListAdapterParametri.ListViewHolder(view);
    }
    public void onBindViewHolder(RecyclerView.ViewHolder holder, int position){
        ((ListAdapterParametri.ListViewHolder) holder).bindView(position);

    }
    public int getItemCount(){
        return MainActivity.ParametriList.size();
    }
    private class ListViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        private TextView mTextPuls;
        private TextView mTextTensiune;
        private TextView mTextInaltime;
        private TextView mTextGreutate;
        private TextView mTextDataParam;

        public ListViewHolder(View itemView){
            super(itemView);
            mTextPuls=(TextView) itemView.findViewById(R.id.textView_puls);
            mTextTensiune=(TextView) itemView.findViewById(R.id.textView_tensiune);
            mTextInaltime=(TextView) itemView.findViewById(R.id.textView_inaltime);
            mTextGreutate=(TextView) itemView.findViewById(R.id.textView_greutate);
            mTextDataParam=(TextView) itemView.findViewById(R.id.textView_data_param);
            itemView.setOnClickListener(this);
        }
        public void bindView(int position){
            mTextPuls.setText(MainActivity.ParametriList.get(position).getPuls()+" "+"batai/min");
            mTextTensiune.setText(MainActivity.ParametriList.get(position).getTensiune()+" "+"mm Hg");
            mTextInaltime.setText(MainActivity.ParametriList.get(position).getInaltime()+" "+"m");
            mTextGreutate.setText(MainActivity.ParametriList.get(position).getGreutate()+" "+"kg");
            mTextDataParam.setText(MainActivity.ParametriList.get(position).getData());
        }
        public void onClick(View view){

        }
    }
}
